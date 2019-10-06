export default {
  SET_TOKEN(state, token) {
    localStorage.setItem('token', token);
  },
  
  SET_FIELDS(state, fields) {
    state.fields = fields;
  },

  MAP_FIELD(state, { fileField, databaseField }) {
    state.map[fileField] = databaseField;
  },

  SET_FINISHED(state, payload) {
    state.finished = payload;
  },
};