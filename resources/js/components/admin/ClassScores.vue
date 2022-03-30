<template>
  <div>
        <v-tabs v-model="tab" :background-color="yellow" centered grow center-active>
            <v-tab v-for="section in classes" :key="section.id" :href="`#${section.class.toLowerCase()}`" @click="$location.hash = `#${section.class.toLowerCase()}`">
                {{ section.class }}
            </v-tab>
        </v-tabs>

        <v-tabs-items v-model="tab">
            <v-tab-item v-for="section in classes" :key="section.id" :value="section.class.toLowerCase()" class="text-center">
                <table class="table table-bordered w-100 text-center">
                    <thead>
                        <th>S/N</th>
                        <th>NUMBER</th>
                        <th>NAME</th>
                        <th class="rotated-text" v-for="subject in section.subjects" :key="subject.alias">
                            <div><span>{{ subject.subject_name }}</span></div>
                            <span style="color: red; font-weight: bolder">{{subject.base_score}}</span>
                        </th>
                    </thead>
                    <tbody>
                        <SingleScore v-for="(student,index) in section.students_sorted" :isadmin="isadmin" :key="student.id" :student="student" :number="index+1" :yellow="yellow" />
                    </tbody>
                </table>

                <v-dialog v-model="dialog" max-width="500" persistent>
                    <v-card>
                        <v-card-title class="headline">{{section.class}}: Add New Candidate</v-card-title>
                        <v-container>
                            <v-text-field v-model="lastname" label="Surname"></v-text-field>
                            <v-text-field v-model="firstname" label="Firstname"></v-text-field>
                        </v-container>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn :disabled="loading" color="green darken-1" text @click="lastname = firstname = null; dialog = false">CLOSE</v-btn>
                            <v-btn :loading="loading" :disabled="loading || !lastname || !firstname" color="green darken-1" text @click="addStudent(section.id)">ADD CANDIDATE</v-btn>
                        </v-card-actions>
                    </v-card>
                </v-dialog>

                <v-snackbar v-model="snackbar">
                    {{ snackbarText }}
                    <v-btn color="pink" text @click="snackbar = false">
                        Close
                    </v-btn>
                </v-snackbar>
            </v-tab-item>
        </v-tabs-items>
  </div>
</template>

<script>
import SingleScore from './SingleScore'

export default {
    name: "ClassScores",
    props: ['allclasses','isadmin'],
    components: {
        SingleScore
    },
    data() {
        return {
            tab: null,
            yellow:  "#e67d23",
            classes: this.allclasses,
            snackbar: false,
            snackbarText: '',
            dialog: false,
            lastname: null,
            firstname: null,
            loading: false,
        }
    },
    methods: {
    },

    mounted() {
        this.tab = this.$location.hash.slice(1);
    }
}
</script>

<style>

</style>
