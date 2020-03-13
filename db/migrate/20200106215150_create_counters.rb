class CreateCounters < ActiveRecord::Migration[6.0]
  def change
    create_table :counters do |t|
      t.datetime :start
      t.datetime :expire
      t.string :text
      t.references :user, null: false, foreign_key: true

      t.timestamps
    end
  end
end
