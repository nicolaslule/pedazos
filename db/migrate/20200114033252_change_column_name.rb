class ChangeColumnName < ActiveRecord::Migration[6.0]
  def change
  	rename_column :counters, :start, :counter_start
  	rename_column :counters, :expire, :counter_ends
  	rename_column :counters, :text, :counter_text
  end
end
