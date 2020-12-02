<template>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <!-- <div v-if="message" class="alert alert-success">
				{{message}}
			</div> -->
            <div class="card">
                <div class="card-header">
                    New Note
                </div>
                <div class="card-body">
                    <form action="#" method="POST" @submit.prevent="store">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input
                                type="text"
                                v-model="form.title"
                                class="form-control"
                                id="title"
                            />
                            <div
                                v-if="errors.title"
                                class="mt-1 text-sm text-danger"
                            >
                                {{ errors.title[0] }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <select
                                v-model="form.subject"
                                id="subject"
                                class="form-control"
                            >
                                <option
                                    v-for="subject in subjects"
                                    :key="subject.id"
                                    :value="subject.id"
                                >
                                    {{ subject.name }}
                                </option>
                            </select>
                            <div
                                v-if="errors.subject"
                                class="mt-1 text-sm text-danger"
                            >
                                {{ errors.subject[0] }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea
                                v-model="form.description"
                                id="description"
                                rows="5"
                                class="form-control"
                            ></textarea>
                            <div
                                v-if="errors.description"
                                class="mt-1 text-sm text-danger"
                            >
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
    name: "Create",

    data() {
        return {
            form: {
                title: "",
                subject: "",
                description: ""
            },
            // message: '',
            subjects: [],
            errors: []
        };
    },

    mounted() {
        this.getSubjects();
    },

    methods: {
        async getSubjects() {
            let response = await axios.get("/api/subjects");
            if (response.status === 200) {
                this.subjects = response.data;
            }
        },

        async store() {
            try {
                let response = await axios.post("/api/create-note", this.form);
                if (response.status === 200) {
                    this.form.title = "";
                    this.form.subject = "";
                    this.form.description = "";
                    this.errors = [];
                    // this.message = response.data.message
                    this.$toasted.show(response.data.message,{
											type: 'success',
											duration: 3000
										});
                }
            } catch (e) {

								this.$toasted.show("Data yang dimasukkan salah.",{
											type: 'error',
											duration: 3000
										});
                this.errors = e.response.data.errors;
            }
        }
    }
};
</script>

<style lang="css" scoped></style>
