<template>
    <modal name="new-project"  classes="py-10 card rounded-lg" height="auto">
        <div class="py-15 w-full h-full">

        <h1 class="font-normal mb-12 text-center text-2xl">Let's start something new!</h1>
            <form @submit.prevent="submit">
                <div class="flex">
                    <div class="flex-1 mr-4">

                        <div class="mb-4">
                            <label for="title" class="text-sm block mb-2">Title</label>
                            <input 
                                type="text" 
                                id="title" 
                                class="border py-2 px-2 text-xs block w-full rounded" 
                                :class="errors.title ? 'border-error-color' : 'border-muted-light'"
                                v-model="form.title">
                                <span class="text-xs text-red italic text-error" v-if="errors.title" v-text="errors.title[0]"></span>
                        </div>

                         <div class="mb-4">
                            <label for="description" class="text-sm block mb-2">Description</label>
                            <textarea 
                                type="text" 
                                id="description" 
                                class="border py-2  px-2 text-xs block w-full rounded" 
                                :class="errors.description ? 'border-error-color' : 'border-muted-light'"
                                rows="7" 
                                v-model="form.description"></textarea>
                               <span class="text-xs text-red italic text-error" v-if="errors.description" v-text="errors.description[0]"></span>
                        </div>

                    </div>
                    <div class="flex-1 ml-4">
                        
                        <div class="mb-4">
                            <label for="task" class="text-sm block mb-2">Tasks</label>
                            <input 
                                type="text" 
                                id="title" 
                                class="border border-muted-light mb-2 py-2  px-2 text-xs block w-full rounded" 
                                placeholder="Add a Task to the project" 
                                v-for="task in form.tasks"
                                v-model="task.body">
                        </div>

                        <button type="button" class="inline-flex items-center" @click="addTask">
                            <svg class="mr-2 fill-current text-teal-500 inline-block h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M11 9h4v2h-4v4H9v-4H5V9h4V5h2v4zm-1 11a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16z"/></svg><span class="text-xs">Add new Task field</span>
                        </button>

                    </div>
                </div>

                <footer class="flex justify-end">
                    <button type="button" class="button is-outlined" @click="$modal.hide('new-project')">Cancel</button>
                    <button @click="post" class="button ml-2">Create Project</button>
                </footer>
            </form>
        </div>
       
    </modal>

</template>


<script>
    export default 
    {
        data() {
            return {
                form: {
                    title: '',
                    description: '',
                    tasks: [
                        { body: '' }
                    ]
                }, 

                errors: {}
            }
        },


        methods: 
        {
            addTask() 
            {
                this.form.tasks.push({ body: '' });
            },

            post() 
            {
                axios.post('/projects', this.form)
                .then(response => {
                    alert(response.data);
                    location = response.data.message;
                })
                .catch(error => {
                     this.errors = error.response.data.errors;
                });
                
                 
            }

        }

    }
</script>