# Module 08: Enrollment & Fee Management

**Status:** ❌ Not Started  
**Business Value:** Flexible fee collection with installments, discounts, and waivers

## Features
- 3/6/12-month installment plans
- Discount, scholarship, fee waiver
- Auto due reminders via SMS & portal

## Database Tables Required
- `fee_structures`
- `fee_collections`
- `installments`
- `discounts`

## Relationships
- FeeStructure → Batch (belongs-to)
- Student → FeeCollection (one-to-many)
- FeeCollection → Installment (one-to-many)