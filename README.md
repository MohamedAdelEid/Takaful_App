# Takaful - Islamic Insurance API

**Project Duration:** July 24, 2024 – August 30, 2024

## Overview
Takaful is a Sharia-compliant Islamic insurance API developed to cater to the needs of Islamic banking transactions in Libya. It offers a fully compliant insurance experience, supporting several types of insurance policies, including:

- **Mandatory Car Insurance**
- **Orange Car Insurance**
- **Traveler Insurance**

The system adheres to Islamic law, providing users and companies with a comprehensive platform to manage, monitor, and generate policies.

## Key Features
### User Features:
- Create and manage various insurance policies.
- Log in, manage accounts, and view policy history.
- Report accidents and request emergency services.
  
### Company Features:
- Track and manage user insurance policies.
- Monitor and analyze insurance activities.
- Generate policy statistics for decision-making.

### Insurance Services:
- **Cost and Premium Calculations**: Automated calculations based on selected policies.
- **Policy Management**: Centralized control for companies to handle user policies.
- **Emergency Services**: Assistance such as car towing and replacements.

### PDF Generation:
- Automated scheduled PDF generation of policy documents using Laravel jobs and queues.

## Technology Stack
- **Backend**: Laravel 10, PHP 8.1
- **Database**: MySQL, designed with entity relationships and mappings.
- **Task Processing**: Laravel Queues (used for tasks like PDF generation).
- **Authentication**: JWT (JSON Web Tokens) for secure API access.

### Packages Used:
- `JWT`: For API authentication.
- `Laravel MPDF`: For generating PDF documents.
- `Laravel countrypkg`: For managing country-specific functionalities.
- `Simple-Qrcode`: For QR code generation in insurance documents.

## Outcome
The project was successfully developed, deployed, and sold, providing a robust, Sharia-compliant solution for Islamic insurance in Libya.
