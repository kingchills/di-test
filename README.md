How to use project
===

1. Clone project
2. Run `composer install`
3. Navigate to `/motor/` and create a motor
4. Navigate to `/car/` and create a car
5. Notice everything should work.
6. Update `composer.json` to have package version of `4.2.3` for `symfony/dependency-injection`
7. Run `composer update`
8. Navigate to `/car/` and create a new car
9. Observe `ORMInvalidArgumentException::newEntitiesFoundThroughRelationships` exception
