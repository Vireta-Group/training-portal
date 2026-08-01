import Cropper from 'cropperjs';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

function initCropper(inputId, previewId, placeholderId, hiddenId, cropAreaId, targetW, targetH) {
    const input = document.getElementById(inputId);
    if (!input) return;

    let cropper = null;
    const cropArea = document.getElementById(cropAreaId);
    const preview = document.getElementById(previewId);
    const placeholder = document.getElementById(placeholderId);
    const hidden = document.getElementById(hiddenId);

    input.addEventListener('change', (e) => {
        const file = e.target.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = (ev) => {
            const src = ev.target.result;

            cropArea.innerHTML = `<img id="crop_img" class="max-w-full" src="${src}" alt="Crop">`;
            cropArea.classList.remove('hidden');

            const img = document.getElementById('crop_img');
            img.onload = () => {
                if (cropper) cropper.destroy();
                cropper = new Cropper(img, {
                    aspectRatio: targetW / targetH,
                    viewMode: 1,
                    autoCropArea: 1,
                    responsive: true,
                });
            };
        };
        reader.readAsDataURL(file);
    });

    document.getElementById('save_crop_btn').addEventListener('click', () => {
        if (!cropper) return;
        const canvas = cropper.getCroppedCanvas({ width: targetW, height: targetH });
        const dataUrl = canvas.toDataURL('image/jpeg', 0.9);
        if (hidden) hidden.value = dataUrl;
        if (preview) {
            preview.src = dataUrl;
            preview.classList.remove('hidden');
        }
        if (placeholder) placeholder.classList.add('hidden');
        cropper.destroy();
        cropper = null;
        cropArea.innerHTML = '';
        cropArea.classList.add('hidden');
    });
}

function initDirectUpload(inputId, previewId, placeholderId) {
    const input = document.getElementById(inputId);
    if (!input) return;

    input.addEventListener('change', (e) => {
        const file = e.target.files[0];
        if (!file) return;
        const preview = document.getElementById(previewId);
        const placeholder = document.getElementById(placeholderId);
        if (preview) {
            preview.src = URL.createObjectURL(file);
            preview.classList.remove('hidden');
        }
        if (placeholder) placeholder.classList.add('hidden');
    });
}

document.addEventListener('DOMContentLoaded', () => {
    initCropper('photo_input', 'photo_preview', 'photo_placeholder', 'photo_base64', 'photo_crop_area', 300, 300);
    initCropper('signature_input', 'signature_preview', 'signature_placeholder', 'signature_base64', 'signature_crop_area', 300, 80);
    initDirectUpload('nid_input', 'nid_preview', 'nid_placeholder');
});
