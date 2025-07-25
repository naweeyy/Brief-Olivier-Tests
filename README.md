# brief_test

[![Laravel Tests](https://github.com/noemarchand/brief_test/actions/workflows/laravel-tests.yml/badge.svg)](https://github.com/noemarchand/brief_test/actions/workflows/laravel-tests.yml)

Projet Laravel avec tests automatisés via GitHub Actions.

## Lancer les tests en local

```bash
php artisan test
```

## Pipeline CI
- Installe PHP, Composer et les dépendances
- Exécute les migrations sur SQLite in-memory
- Lance les tests à chaque push ou pull request

Voir le badge ci-dessus pour le statut !
