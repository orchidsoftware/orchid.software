#!/bin/bash
base=/home/admin/web/orchid.software/public_html/storage/app/platform
docs=${base}

cd ${docs} && git reset --hard HEAD && git pull
