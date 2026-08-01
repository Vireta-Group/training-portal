# Module 16: Certificate Management

**Status:** ❌ Not Started  
**Business Value:** Auto-generated professional certificates with online verification

## Features
- Drag-and-drop template editor
- QR code for online verification
- Bulk generation & print

## Database Tables Required
- `certificate_templates`
- `certificates`

## Relationships
- Certificate → Student (belongs-to)
- Certificate → Template (belongs-to)
- Certificate → Batch (belongs-to)