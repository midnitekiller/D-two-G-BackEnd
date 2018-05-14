# -*- mode: ruby -*-
# vi: set ft=ruby :

# All Vagrant configuration is done below. The "2" in Vagrant.configure
# configures the configuration version (we support older styles for
# backwards compatibility). Please don't change it unless you know what
# you're doing.
Vagrant.configure("2") do |config|
 
  config.vm.box = "ubuntu-14"


  # config.vm.box_check_update = false


  # config.vm.network "forwarded_port", guest: 80, host: 8080
  # config.vm.network "forwarded_port", guest: 80, host: 8080, host_ip: "127.0.0.1"

  config.vm.network "private_network", ip: "192.168.33.33"
  config.vm.network "public_network"

  config.vm.synced_folder "./data", "/vagrant_data"

  # Provider-specific configuration so you can fine-tune various
  # backing providers for Vagrant. These expose provider-specific options.
  # Example for VirtualBox:
  #
  # config.vm.provider "virtualbox" do |vb|
  #   # Display the VirtualBox GUI when booting the machine
  #   vb.gui = true
  #
  #   # Customize the amount of memory on the VM:
  #   vb.memory = "1024"
  # end
  #
  # View the documentation for the provider you are using for more
  # information on available options.

  config.vm.provision "shell", inline: <<-SHELL
    sudo -i
    apt-get update -y
    apt-get install -y apache2
    apt-get install debconf-utils -y
    debconf-set-selections <<< 'mysql-server-5.5 mysql-server/root_password password qwe123'
    debconf-set-selections <<< 'mysql-server-5.5 mysql-server/root_password_again password qwe123'
    apt-get -y install mysql-server-5.5
    apache2ctl configtest
    apt-get install -y php5 php5-common libapache2-mod-php5 php5-mysql php5-fpm php5-mcrypt php5-curl
    apt-get install -y curl
  SHELL
end
