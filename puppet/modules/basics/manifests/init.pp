class basics {
  package {['vim', 'tmux', 'zsh']:
    ensure => installed
  }

  file {'/home/vagrant/.vimrc':
    source  => 'puppet:///modules/basics/.vimrc',
    owner   => 'vagrant',
    group   => 'vagrant',
    mode    => '0644',
    require => Package['vim']
  }

  file {'/home/vagrant/.tmux.conf':
    source  => 'puppet:///modules/basics/.tmux.conf',
    owner   => 'vagrant',
    group   => 'vagrant',
    mode    => '0644',
    require => Package['tmux']
  }

  file {'/home/vagrant/.zshrc':
    source  => 'puppet:///modules/basics/.zshrc',
    owner   => 'vagrant',
    group   => 'vagrant',
    mode    => '0644',
    require => Package['zsh']
  }

  file {'/usr/local/sbin/pupd':
    source => 'puppet:///modules/basics/pupd',
    owner  => 'root',
    group  => 'root',
    mode   => '0744'
  }

  exec {'oh-my-zsh':
    cwd     => '/home/vagrant',
    path    => '/bin:/usr/bin',
    unless  => 'test -d "/home/vagrant/.oh-my-zsh"',
    command => 'git clone git://github.com/robbyrussell/oh-my-zsh.git .oh-my-zsh',
    creates => '/home/vagrant/.oh-my-zsh',
    require => Package['git', 'zsh']
  }

  exec {'to-zsh':
    path    => '/bin:/usr/bin',
    unless  => 'bash -c \'test "`getent passwd vagrant | cut -d: -f7`" == "/usr/bin/zsh"\'',
    command => 'chsh -s /usr/bin/zsh vagrant',
    require => Package['zsh']
  }

  exec {'fix-path':
    cwd     => '/home/vagrant',
    path    => '/bin:/usr/bin',
    unless  => 'grep -qs vagrant_ruby .zshrc',
    command => 'echo export PATH=\$PATH:/opt/vagrant_ruby/bin >> .zshrc',
    require => File['/home/vagrant/.zshrc']
  }

  exec {'add-vagrant-to-www-data':
    unless  => "grep -q 'www-data\\S*vagrant' /etc/group",
    path    => '/bin:/usr/bin:/usr/sbin',
    command => 'usermod -aG www-data vagrant'
  }
}
