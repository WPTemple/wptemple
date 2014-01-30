class mysql::install {
  $password = 'vagrant'

  package {['mysql-server', 'mysql-client']:
    ensure => installed
  }

  exec {'Set MySQL root password':
    subscribe => [
      Package['mysql-server'],
      Package['mysql-client']
    ],
    refreshonly => true,
    unless      => "mysqladmin -uroot -p${password} status",
    path        => '/bin:/usr/bin',
    command     => "mysqladmin -uroot password ${password}"
  }
}
