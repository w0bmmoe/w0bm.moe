#!/bin/bash
cd /var/www/w0bm.moe/resources/views
rm register.blade.php
ln -s registerclosed.blade.php register.blade.php
php lel view:clear
