class RemoveCounterStartFromCounters < ActiveRecord::Migration[6.0]
  def change

    remove_column :counters, :counter_start, :datetime
  end
end
