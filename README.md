## Probe

### Installation

1. `git clone https://github.com/navystyle/probe`

2. copy/paste `config/settings.sample` file to `config/settings.php`.

3. `composer install`
 
### Migrating schema
1. `./vendor/bin/propel database:revserse probe` create `schema.xml` into `/generated-reversed-database/`

2. move the contents of `/generated-reversed-database/schema.xml` to `/propel/probe.schema.xml`

3. propel model build `./vendor/bin/propel model:build` makes model into `/src/App/Models/`

### Routes
using slim annotation route right here `/src/App/Controllers/`