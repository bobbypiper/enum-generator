# Enum Generator

[![build](https://github.com/genkiroid/enum-generator/actions/workflows/ci.yml/badge.svg)](https://github.com/genkiroid/enum-generator/actions/workflows/ci.yml)

Generate PHP class definition that extends Enum class from file(yaml, json).

## Installation

```sh
composer require genkiroid/enum-generator
```

## Usage

Generate to STDOUT.

```sh
enum-generator --in enums.yaml
```

Generate to files. (Specify output dir.)

```sh
enum-generator --in enums.yaml --out /tmp/enums/
```

Generate to files. (Overwrite.)

```sh
enum-generator --in enums.yaml --out /tmp/enums/ --force
```

Specify a namespace

```sh
enum-generator --in enums.yaml --namespace="My/Namespace"
```

## Input file format

### YAML

```yaml
---
- User:
    state:
      active: 0
      inactive: 1
- Shop:
    state:
      active: 0
      inactive: 1
```

### JSON

```json
[
  {
    "User": {
      "state": {
        "active": 0,
        "inactive": 1
      }
    }
  },
  {
    "Shop": {
      "state": {
        "active": 0,
        "inactive": 1
      }
    }
  }
]
```

## Output

STDOUT.

```php
<?php

class UserState extends Enum
{
    const ACTIVE = 0;
    const INACTIVE = 1;
}
<?php

class ShopState extends Enum
{
    const ACTIVE = 0;
    const INACTIVE = 1;
}
```

Files.

```sh
UserState.php
ShopState.php
```

## Tips

You can use [genkiroid/enum_exporter](https://github.com/genkiroid/enum_exporter) to create input file from existing Ruby on Rails application.

## License

[MIT](https://github.com/genkiroid/enum-generator/blob/master/LICENSE)

## Author

[genkiroid](https://github.com/genkiroid)

