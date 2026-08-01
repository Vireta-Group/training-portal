# Module 04: Branch Management

**Status:** ❌ Not Started  
**Business Value:** Centers with multiple branches manage them separately

## Features
- Create unlimited branches
- Branch-wise P&L
- Assign staff & students to specific branches

## Database Tables Required
- `branches`

## Existing Tables to Modify
- `students` → add `branch_id` (nullable FK)
- `users` (staff) → add `branch_id` (nullable FK)
- `batches` → add `branch_id` (nullable FK)
- `courses` → add `branch_id` (nullable FK)