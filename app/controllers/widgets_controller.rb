class WidgetsController < ApplicationController
  protect_from_forgery except: :show

  def show
    respond_to do |format|
      format.html { render params[:template], layout: 'widgets' }
      format.js   { render js: js_constructor }
    end
  end

  private
  def js_constructor
    content = render_to_string(params[:template], layout: false)
    "document.write(#{content.to_json})"
  end
end
