# Code Mode Rules

## Module Structure
When creating a new module, follow this exact structure:
```
src/<Module>/
  Controllers/  Models/  Requests/  Resources/  Rules/  Services/  UseCases/
  routes.php
```

## Request Flow Order
1. Controller (thin wrapper)
2. FormRequest validation (if exists)
3. UseCase (orchestration entry point)
4. RulesPipeline (business rules validation)
5. Services (business logic)
6. Model operations + OutboxEvent writing

## Naming Conventions
- UseCases: `*UseCase.php` (e.g., `CreateOrderUseCase.php`)
- Rules: `*Rule.php` (e.g., `ValidateOrderWeight.php`)
- Services: `*Service.php` (e.g., `OrderPricingService.php`)
- Resources: `*Resource.php` (e.g., `OrderResource.php`)

## Error Handling
- Use `BusinessRuleException` for business logic violations (e.g., duplicate orders, invalid weights)
- Controllers should never throw exceptions directly — delegate to UseCases
- UseCases should throw `BusinessRuleException` for rule violations

## Imports
- Always import from `Src\` namespace for module-specific code
- Use `App\` namespace for framework classes (Controllers, Models, Providers)
- Shared utilities from `Src\Shared\`

## Resources
- Resources are for API response serialization (not DTOs)
- Use `Src\Shared\Traits\ApiResponse` for consistent response formatting
- Resources should be read-only (no setters)
