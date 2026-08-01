param(
    [string]$Host,
    [string]$Username,
    [string]$Password,
    [string]$TargetDir = "/public_html"
)

if (-not $Host -or -not $Username -or -not $Password) {
    Write-Host "=== FTP Deploy to cPanel ===" -ForegroundColor Cyan
    $Host = Read-Host "FTP Host"
    $Username = Read-Host "FTP Username"
    $Password = Read-Host "FTP Password" -AsSecureString
    $Password = [System.Runtime.InteropServices.Marshal]::PtrToStringAuto(
        [System.Runtime.InteropServices.Marshal]::SecureStringToBSTR($Password)
    )
    $TargetDir = Read-Host "Target Directory (default: /public_html)"
    if (-not $TargetDir) { $TargetDir = "/public_html" }
}

Write-Host "`n=== Building assets ===" -ForegroundColor Yellow
npm ci
npm run build

Write-Host "=== Installing composer (no dev) ===" -ForegroundColor Yellow
composer install --no-dev --optimize-autoloader --no-interaction

Write-Host "=== Deploying to cPanel via FTP ===" -ForegroundColor Yellow

$localPath = (Get-Location).Path
$exclude = @(".git", ".env", "node_modules", "tests", "phpunit.xml", "mysql_data.sql", "mysql_data2.sql", "mysql_data_pg.sql")

# Create FTP connection
$ftp = [System.Net.FtpWebRequest]::Create("ftp://$Host$TargetDir/")
$ftp.Method = [System.Net.WebRequestMethods+Ftp]::ListDirectory
$ftp.Credentials = New-Object System.Net.NetworkCredential($Username, $Password)
$ftp.UsePassive = $true
$ftp.UseBinary = $true

try {
    $response = $ftp.GetResponse()
    Write-Host "FTP connection OK" -ForegroundColor Green
    $response.Close()
} catch {
    Write-Host "FTP connection failed: $_" -ForegroundColor Red
    exit 1
}

function Upload-Directory {
    param($LocalPath, $RemotePath)

    Get-ChildItem -LiteralPath $LocalPath | ForEach-Object {
        $item = $_
        $isExcluded = $false
        foreach ($ex in $exclude) {
            if ($item.Name -eq $ex -or $item.Name -like $ex) { $isExcluded = $true; break }
        }
        if ($isExcluded) { return }

        $remoteItem = "$RemotePath/$($item.Name)" -replace '\\', '/' -replace '//', '/'

        if ($item.PSIsContainer) {
            try {
                $dirReq = [System.Net.FtpWebRequest]::Create("ftp://$Host$remoteItem/")
                $dirReq.Method = [System.Net.WebRequestMethods+Ftp]::MakeDirectory
                $dirReq.Credentials = New-Object System.Net.NetworkCredential($Username, $Password)
                $dirReq.UsePassive = $true
                $null = $dirReq.GetResponse()
                Write-Host "  DIR+ $remoteItem" -ForegroundColor DarkGray
            } catch {}
            Upload-Directory $item.FullName $remoteItem
        } else {
            try {
                $fileReq = [System.Net.FtpWebRequest]::Create("ftp://$Host$remoteItem")
                $fileReq.Method = [System.Net.WebRequestMethods+Ftp]::UploadFile
                $fileReq.Credentials = New-Object System.Net.NetworkCredential($Username, $Password)
                $fileReq.UsePassive = $true
                $fileReq.UseBinary = $true
                $fileBytes = [System.IO.File]::ReadAllBytes($item.FullName)
                $stream = $fileReq.GetRequestStream()
                $stream.Write($bytes, 0, $bytes.Length)
                $stream.Close()
                $fileReq.GetResponse().Close()
                Write-Host "  OK  $remoteItem" -ForegroundColor Green
            } catch {
                Write-Host "  FAIL $remoteItem : $_" -ForegroundColor Red
            }
        }
    }
}

Upload-Directory $localPath $TargetDir

Write-Host "`n=== Deploy complete! ===" -ForegroundColor Green
Write-Host "`nNow run these in cPanel Terminal:" -ForegroundColor Cyan
Write-Host "  cd $TargetDir" -ForegroundColor White
Write-Host "  php artisan migrate --force" -ForegroundColor White
Write-Host "  php artisan optimize" -ForegroundColor White
Write-Host "  php artisan storage:link" -ForegroundColor White