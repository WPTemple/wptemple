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

  file {'/etc/nginx/nginx.conf':
    owner   => root,
    group   => root,
    mode    => '0644',
    require => Package['nginx'],
    source  => 'puppet:///nginx/nginx.conf',
    notify  => Service['nginx']
  }

  exec {'add-vagrant-to-www-data':
    unless  => "grep -q 'www-data\\S*vagrant' /etc/group",
    path    => '/bin:/usr/bin:/usr/sbin',
    command => 'usermod -aG www-data vagrant'
  }

  vhost {"${hostname}":
    name    => "${hostname}",
    wwwroot => '/vagrant',
    notify  => Service['nginx']
  }
}
