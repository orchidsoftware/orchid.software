# Orchid Website

![Build and Deploy](https://github.com/orchidsoftware/orchid.software/workflows/Build%20and%20Deploy/badge.svg?branch=master)

This is the repository for website at [orchid.software](http://orchid.software).

The docs are auto-generated and each page has an edit button. So if you come across any errors, or if you think of anything else that should be included, then please make the changes and submit them as a pull-request.

## Contributing

If you spot any errors, typos or missing information, please submit a pull
request.

## Building 

Let’s build the site.

```bash
# build static files with Jigsaw
./vendor/bin/jigsaw build

# compile assets with Laravel Mix
# options: dev, staging, production
npm run dev
```
