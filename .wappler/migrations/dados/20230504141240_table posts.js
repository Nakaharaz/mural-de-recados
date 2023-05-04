
exports.up = function(knex) {
  return knex.schema
    .createTable('posts', async function (table) {
      table.increments('id');
      table.string('title');
      table.text('content');
    })

};

exports.down = function(knex) {
  return knex.schema
    .dropTable('posts')
};
