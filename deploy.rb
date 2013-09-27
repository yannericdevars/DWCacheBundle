default_run_options[:pty] = true

# SSH conf
ssh_options[:forward_agent] = true

# Git
set :github_user, 'yannericdevars'
set :github_application, "DWCacheBundle"
set :repository, "git@github.com:#{github_user}/#{github_application}.git"
set :scm, 'git'
set :git_shallow_clone, 1
set :keep_releases, 10

# Debug
set :scm_verbose, true
set :use_sudo, false
set :application, 'DWCacheBundle'



# Multi-staging configuration
# cap production deploy
task :production do
  role :web, "site.local"
  # SSH
  set :user, '' #ssh login
  set :password, '' #ssh Password
  set :domain, '' #your ip/server
  set :application, 'DWCacheBundle' #app name
  set :deploy_to, "/var/www/" #deploypath
  set :deploy_via, :remote_cache
  set :branch, 'master'

end

# Override default tasks which are not relevant to a non-rails app.
namespace :deploy do
  task :migrate do
    puts " not doing migrate because not a Rails application."
  end
  task :finalize_update do
    puts " not doing finalize_update because not a Rails application."
  end
  task :start do
    puts " not doing start because not a Rails application."
  end
  task :stop do
    puts " not doing stop because not a Rails application."
  end
  task :restart do
    puts " not doing restart because not a Rails application."
  end
end
