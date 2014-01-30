exec {'apt-update':
  path    => '/usr/bin',
  command => 'apt-get update'
}

class {'git::install': }
class {'mysql::install': }
class {'basics': }
class {'nginx': }
class {'php5-fpm': }
class {'wordpress': }
