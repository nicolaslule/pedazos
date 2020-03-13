Rails.application.routes.draw do
  resources :counters
  root 'counters#index'
  devise_for :users
  get '/widgets/:template', to: 'widgets#show'
  
  # For details on the DSL available within this file, see https://guides.rubyonrails.org/routing.html
end


