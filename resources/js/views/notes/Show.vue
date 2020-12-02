<template>
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header  bg-primary text-white"><h5>{{note.title}}</h5></div>
        <div class="card-body">{{note.description}}</div>
        <div class="card-footer text-secondary">
          {{note.subject}}, {{note.published}}
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data(){
    return{
      note: []
    }
  },
  mounted(){
    this.getNote();
  },

  methods: {
    async getNote(){
      let response = await axios.get('/api/notes/' + this.$route.params.noteSlug)
      this.note = response.data.data
    }
  }
}
</script>

<style>

</style>