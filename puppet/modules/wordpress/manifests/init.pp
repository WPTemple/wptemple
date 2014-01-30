class wordpress {
  $mysql_user = 'wordpress'
  $mysql_pass = 'wordpress'
  $schema     = 'wordpress'

  $wp_root    = '/vagrant'
  $wp_dl      = 'http://wordpress.org/latest.tar.gz'

  include setup_db
  include dl_and_install
}

class wordpress::setup_db {
  exec {'create-database':
    path    => '/usr/bin',
    unless  => 'mysql -uroot -pvagrant wordpress',
    command => 'mysql -uroot -pvagrant --execute \'create schema wordpress\''
  }

  exec {'create-user':
    path    => '/usr/bin',
    unless  => "mysql -u${mysql_user} -p${mysql_pass}",
    command => "mysql -uroot -pvagrant --execute 'grant all on ${schema}.* to ${mysql_user}@localhost identified by \"${mysql_pass}\"'",
    require => Exec['create-database']
  }
}

class wordpress::dl_and_install {
  exec {'download-wordpress':
    path    => '/bin:/usr/bin',
    cwd     => "${wp_root}",
    unless  => 'test -e latest.tar.gz',
    command => "wget ${wp_dl}",
    creates => "${wp_root}/latest.tar.gz"
  }

  exec {'untar-wordpress':
    path    => '/bin:/usr/bin',
    cwd     => "${wp_root}",
    unless  => 'test -e wp-load.php',
    command => 'tar xvzf latest.tar.gz; mv wordpress/* .; rmdir wordpress',
    require => Exec['download-wordpress']
  }
}
