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
}
