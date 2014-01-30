class nginx {
  package {'nginx':
    ensure => installed
  }

  service {'nginx':
    ensure     => running,
    enable     => true,
    hasrestart => true,
    hasstatus  => true,
    require    => Package['nginx']
  }

  vhost {"${hostname}":
    name    => "${hostname}",
    wwwroot => '/vagrant',
    notify  => Service['nginx']
  }
}
