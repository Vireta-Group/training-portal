# Module 10: Attendance System

**Status:** ❌ Not Started  
**Business Value:** Mandatory for government projects

## Features
- Student mobile QR scan
- Manual entry by trainer
- Late entry marking
- Monthly & project-wise reports

## Database Tables Required
- `attendance`

## Relationships
- Attendance → Student (belongs-to)
- Attendance → Batch (belongs-to)
- Attendance → Employee (belongs-to, recorded by)