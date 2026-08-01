# Module 15: Exam & Result Management

**Status:** ❌ Not Started  
**Business Value:** Publish results instantly

## Features
- Auto marksheet, GPA/CGPA, merit position
- Publish to student portal + SMS
- Printable report card

## Database Tables Required
- `exams`
- `exam_results`
- `merit_lists`

## Relationships
- Exam → Assessment (belongs-to)
- Exam → Batch (belongs-to)
- ExamResult → Student (belongs-to)