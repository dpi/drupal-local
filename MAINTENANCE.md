Maintenance for dpi/drupal-local

After changes, use the following for building the commit message:

```shell
./bin/composer-lock-diff --md --no-links
```

# Importing data

You can start a new copy of this project, bringing along old site
configurations for the ride.

1. Set up the new project as per README.md
2. Export configuration from the site, then copy the config directory to the
   new site.
3. On the new site, set the site UUID to the old UUID with
   `drush config:set system.site uuid THEUUIDISHERE -y`
4. Then run `drush config:import -y`
