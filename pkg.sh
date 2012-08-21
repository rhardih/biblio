#!/usr/bin/env bash

# Create initial archive
git archive --format=zip --prefix=biblio/ HEAD > biblio.zip

# Remove unwanted files from archive
zip -d biblio biblio/\*.scss biblio/.gitignore biblio/pkg.sh

# Compile css
sass -t compressed styles.scss:styles.css
sass -t compressed widget.scss:widget.css

# Add css files to archive
cd ..
zip biblio/biblio biblio/styles.css biblio/widget.css
cd -
