# wp-fasto-child-theme

minor theme modifications for using [fasto](https://wordpress.org/support/theme/fasto/) on [open-mind-culture.org](https://www.open-mind-culture.org/)

## Modifications

- text 404 without "oh boy"
- instant focus in search input
- footer "made by" => "theme made by"

## Installation

- create a zip archive of the directory `fasto-child`
  (or download from GitHub)
- open WordPress administration (usually `/wp-admin`)
- open themes page
- add theme by uploading zip file
- activate theme

## Development

- checkout the original [fasto theme](https://wordpress.org/support/theme/fasto/) as parent theme into `/themes/fasto`
  (download from WordPress plugin page or, with `subversion` installed: 
  
```
cd wordpress/themes
svn co https://themes.svn.wordpress.org/fasto/1.5.6/ fasto
```

- mount the themes folder into a local WordPress docker container, or
  run
  
```
docker-compose up
```

### Optional: Install WordPress Plugins

Inside your WordPress docker container, you can use [wp-cli](https://wp-cli.org/) ...

```
docker-compose run --rm cli bash
cd /var/www/html/
```

... to install any plugin like, for example, Yoast SEO:

```
./wp-cli.phar plugin install wordpress-seo # Yoast SEO
```

### Child Theme Development Resources

[developer.wordpress.org/themes/advanced-topics/child-themes/](https://developer.wordpress.org/themes/advanced-topics/child-themes/)
