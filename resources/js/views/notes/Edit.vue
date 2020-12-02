<template>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <!-- <div v-if="message" class="alert alert-success">
				{{message}}
			</div> -->
            <div class="card">
                <div class="card-header">
                    Edit Note
                </div>
                <div class="card-body">
                    <form action="#" method="POST" @submit.prevent="update">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" v-model="form.title" class="form-control" id="title"/>
                            <div v-if="errors.title" class="mt-1 text-sm text-danger">
                                {{ errors.title[0] }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <select @change="selectedSubject" id="subject" class="form-control">
                              <option :value="form.subjectId" v-text="form.subject"></option>
                              <template v-for="subject in subjects">
                                <option v-if="form.subjectId !== subject.id" :key="subject.id" :value="subject.id">
                                    {{ subject.name }}
                                </option>
                              </template>
                            </select>
                            <div v-if="errors.subject" class="mt-1 text-sm text-danger">
                                {{ errors.subject[0] }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea v-model="form.description" id="description" rows="5" class="form-control"></textarea>
                            <div v-if="errors.description" class="mt-1 text-sm text-danger">
                                {{ errors.description[0] }}
                            </div>
                        </div>
                        <button type="sumbit" class="btn btn-block btn-primary">
                            Save
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Edit",

    data() {
        return {
            form: [],
            subjects: [],
            errors: [],
            selected: ''
        };
    },

    mounted() {
        this.getSubjects();
        this.getNote();
    },

    methods: {
        async getSubjects() {
            let response = await axios.get("/api/subjects");
            if (response.status === 200) {
                this.subjects = response.data;
            }
        },
        async getNote(){
          let response = await axios.get(`/api/notes/${this.$route.params.noteSlug}`);
          this.form = response.data.data
        },

        selectedSubject(e){
          this.selected = e.target.value
        },

        async update(){
          this.form['subject'] = this.selected  || this.form.subjectId;
          let response = await axios.patch(`/api/notes/${this.$route.params.noteSlug}/edit`, this.form);
          if(response.status === 200){
            this.$toasted.show(response.data.message,{
              type: 'success',
              duration: 3000
            })
            this.$router.push('/notes/table');
            // window.location.href = '/notes/table'
          }
        }
    }
};
</script>
