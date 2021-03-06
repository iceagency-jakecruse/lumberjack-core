# Change Log
All notable changes to this project will be documented in this file.
This project adheres to [Semantic Versioning](http://semver.org/).

## 3.3.0 (2018-07-17)

### Features

- Add `runningInConsole()` function to `Application`
- Add `mergeConfigFrom()` function to `ServiceProvider`
- Add warning to log when no WP Controller is found

## 3.2.1 (2018-05-27)

### Bug Fixes

- Prevent duplicate headers being sent

## 3.2.0 (2018-05-10)

### Features

- Add `Responsable` interface which can be used as a return object in Controllers or added to Exceptions and automatically handled by the application.
- Add `Helpers` class with the following functions `app()`, `config()`, `view()`, `route()` & `redirect()`. These can be added to the global namespace by including the `src/functions.php` file.

## 3.1.0 (2018-03-28)

### Features

- Add support for view models

## 3.0.0 (2018-03-23)
- Initial release. Starting at v3 to keep inline with Lumberjack theme version
