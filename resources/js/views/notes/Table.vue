<template>
  <div class="row justify-content-center">
    <div class="col-md-6">
      <h2 class="font-weight-bold text-center">My Note</h2>
      <hr>
      <div v-for="note in notes" :key="note.slug" class="card mb-2">
        <div class="card-body">
          <h5 class="font-weight-bolder"><router-link :to="{name: 'notes.show', params:{noteSlug: note.slug}}">{{note.title}}</router-link></h5>
          <div class="text-sm">{{note.subject}}</div>
          <p class="text-secondary">{{note.published}}</p>
          <router-link :to="{name: 'notes.edit', params:{noteSlug: note.slug}}" class="btn btn-sm btn-dark">Edit</router-link>
          <delete-note :endpoint="note.slug" />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import DeleteNote from './Delete'
export default {
  components: {
    DeleteNote
  },

  data(){
    return{
      notes: [],
    }
  },

  mounted(){
    this.getNotes()
  },

  methods: {
    async getNotes(){
      let response = await axios.get('/api/notes');
      this.notes = response.data.data
    }
  }
}
</script>

<style>

</style>