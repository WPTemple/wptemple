class phpmyadmin {
  $wwwroot = '/vagrant'
  $dbuser = 'phpmyadmin'
  $dbpass = 'vagrant'
  $dbname = 'phpmyadmin'

  package {'phpmyadmin':
    ensure  => installed,
    require => Package['nginx', 'php5-fpm']
  }

  file {'/etc/phpmyadmin/config-db.php':
    owner   => 'root',
    group   => 'www-data',
    mode    => '640',
    replace => true,
    content => template('phpmyadmin/config-db.php.erb')
  }

  file {'/etc/dbconfig-common/phpmyadmin.conf':
    owner   => 'root',
    group   => 'root',
    mode    => '600',
    replace => true,
    content => template('phpmyadmin/dbconfig-common-phpmyadmin.conf.erb')
  }

  file {"${wwwroot}/phpmyadmin":
    ensure => 'link',
    target => '/usr/share/phpmyadmin'
  }
}
