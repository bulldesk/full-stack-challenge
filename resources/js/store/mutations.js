export default {
  SET_FIELDS(state, fields) {
    state.fields = fields;
  },

  MAP_FIELD(state, { fileField, databaseField }) {
    state.map[fileField] = databaseField;
  }
};