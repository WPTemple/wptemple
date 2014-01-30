class mysql::install {
  $password = 'vagrant'

  package {'mysql-server':
    ensure => installed
  }

  exec {'Set MySQL root password':
    subscribe   => Package['mysql-server'],
    refreshonly => true,
    unless      => "mysqladmin -uroot -p${password} status",
    path        => '/bin:/usr/bin',
    command     => "mysqladmin -uroot password ${password}"
  }
}

class mysql::php5-mysql {
  package {'php5-mysql':
    ensure  => installed,
    require => Package['php5-fpm'],
    notify  => Service['php5-fpm']
  }
}
