<template>
    <div>
        <h4>Exams in progress...</h4>
        <hr>
        <div v-if="allExams.length > 0" class="container">
            <div class="row">
                <StartedExam v-for="exam in allExams" :key="exam.id" :exam="exam" :yellow="yellow" @endExam="endExam"/>
            </div>
        </div>
        <p v-else>There are currently no examinations in progress</p>
        <hr>

        <v-tabs v-model="tab" :background-color="yellow" centered grow center-active>
            <v-tab v-for="section in classes" :key="section.id" :href="`#${section.class.toLowerCase()}`" @click="$location.hash = `#${section.class.toLowerCase()}`">
                {{ section.class }}
            </v-tab>
        </v-tabs>

        <v-tabs-items v-model="tab">
            <v-tab-item v-for="section in classes" :key="section.id" :value="section.class.toLowerCase()" class="text-center">
                <div class="container-fluid">
                    <v-expansion-panels accordion hover focusable>
                        <v-expansion-panel class="col-md-4 border m-1" v-for="subject in section.subjects" :key="subject.id">
                                <v-expansion-panel-header><h6>{{subject.subject_name.toUpperCase()}}</h6></v-expansion-panel-header>
                                    <v-expansion-panel-content>
                                        <SingleClass :single="single" :subject="subject" :exams="allExams" :yellow="yellow" @startNewExam="startNewExam" @endExam="endExam" v-for="single in subject.classes" :key="single.id" />
                                    </v-expansion-panel-content>
                        </v-expansion-panel>
                    </v-expansion-panels>
                </div>
            </v-tab-item>
        </v-tabs-items>
    </div>
</template>

<script>
import SingleClass from './SingleClass';
import StartedExam from './StartedExam';

export default {
    name: "ClassExams",
    props: ['classes', 'exams'],
    data() {
        return {
            yellow: "#e67d23",
            dark: "#343a40",
            allExams: this.exams,
            tab: null,
        }
    },
    components: {
        SingleClass,
        StartedExam
    },
    methods: {
        startNewExam(exam) {
            let newExam = {id: exam.id, subject: exam.subject, class: exam.class}
            this.allExams.push(newExam)
        },

        endExam(id) {
            this.allExams = this.allExams.filter(exam => exam.id !== id)
        }
    }
}
</script>

<style scoped>
.active {
    background-color: #343a40;
    color: #e67d23;
    border: solid #343a40 1px;
}
</style>
