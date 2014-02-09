# vagrant-wordpress-lemp
A somewhat reasonable Vagrant setup that might be useful for quick WordPress development environments.

This setup contains the following:
### Servers and Configurations
+ Nginx
+ MySQL
+ PHP-FPM
+ phpMyAdmin
+ Puppet

### Extras
+ zsh + oh-my-zsh
+ vim + .vimrc
+ tmux + .tmux.conf

And of course, WordPress.

## Usage
To start, fork this repository and clone it. You should then configure the `config.vm.hostname`, `config.vm.network`, etc. in `Vagrantfile` to your liking.

If you wish to create a totally new WordPress installation, simply run `vagrant up` inside the new directory. If you are importing an existing WordPress installation, copy your `wp-content` directory (or theoretically any other files you want).

When you run `vagrant up`, if all goes well the VM will start, and Puppet will begin configuration and installation of WordPress.

### Connecting
You may connect via SSH to the new machine by running `vagrant ssh`. To connect with a web browser, use the IP you provided in the `Vagrantfile` or, if you have the Vagrant HostsUpdater plugin installed, the hostname.

### Users and Passwords (be sure to change these)

Account     | Username  | Password
------------|-----------|---------
Login       | vagrant   | vagrant
root        | root      | vagrant
phpMyAdmin  | root      | vagrant
MySQL       | root      | vagrant
MySQL WP DB (wordpress) | wordpress | wordpress
