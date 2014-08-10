exec {'apt-update':
  path    => '/usr/bin',
  command => 'apt-get update'
}

class {'mysql::install': }
class {'nginx': }
class {'php5-fpm': }
class {'wordpress': }
class {'phpmyadmin': }
