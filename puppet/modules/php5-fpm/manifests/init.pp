class php5-fpm {
  package {'php5-fpm':
    ensure => installed
  }

  service {'php5-fpm':
    ensure     => running,
    enable     => true,
    hasrestart => true,
    hasstatus  => true,
    require    => Package['php5-fpm']
  }

  file {'/etc/php5/fpm/pool.d/www.conf':
    owner   => root,
    group   => root,
    mode    => '0644',
    source  => 'puppet:///php5-fpm/www.conf',
    notify  => Service['php5-fpm'],
    require => Package['php5-fpm']
  }

  include mysql::php5-mysql
}
