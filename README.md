# Nette flat-file blog example
This repository demonstrates how to use multiple modules in nette application

## Run the blog
Minimum required PHP version is **8.0**
```
php -S localhost:80 -t public/
```

## What can you learn?
- Automatically registering services using SearchExtension
- How to design an optimal skeleton for bigger applications
- How to create links between multiple modules
- Using a better module mapping (in /config/main.neon)
- How to use nette/forms with factories, and where to put handling logic
- Creating custom form renderer
- Neon config files can be separated and included to main file
- How to change layout and template paths (in base presenters)
- Router can be used as a service
- How to delegate model logic to keep codebase clean
