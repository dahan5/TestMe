<template>
    <div class="container">
        <div class="row">
            <div class="text-center col-md-6">
            Examination Date / Duration / Aggregate Score: <strong>{{refinedDate}} / {{examtime}} / {{totalMarks}} marks</strong> <span v-show="!exam.hasBeenWritten">(<a href="#change" @click.prevent="dialog = true">Change</a>)</span>
            </div>
            <!-- <div class="col-md-1"></div> -->
            <div class="col-md-6">
                <div class="float-right">
                    <v-btn v-show="!exam.hasBeenWritten && examCount > 1" :color="yellow" @click="$emit('alterPQList', 'open')" small tile title="Import some of the previous examination questions into the current examination">
                        EXAM PQ TEMPLATES
                    </v-btn>
                    <v-btn v-show="exam.date == today && questionCount > 0 && !exam.hasStarted" :color="yellow" @click="examDialog = true" small tile title="Start this Examination">
                        START EXAM
                    </v-btn>
                    <v-btn v-show="exam.hasStarted" :color="yellow" @click="examDialog = true" small tile title="End examination">
                        END EXAM
                    </v-btn>
                    <v-btn v-show="exam.hasBeenWritten && !exam.hasStarted" @click="dialog=true" class="ml-2" :color="yellow" small tile title="Create New Examination">
                        CREATE NEW EXAM
                    </v-btn>
                </div>
            </div>
        </div>

        <v-snackbar v-model="snackbar">
            {{ snackbarText }}
            <v-btn color="pink" text @click="snackbar = false">
                Close
            </v-btn>
        </v-snackbar>

        <v-dialog v-model="examDialog" max-width="350">
            <v-card>
                <v-card-title v-if="!exam.hasStarted" class="headline">Start Exam?</v-card-title>
                <v-card-title v-else class="headline">End Exam?</v-card-title>
                <v-card-text v-if="!exam.hasStarted">
                Please confirm that you want to start this exam: <strong>{{exam.subject.subject_name}} ({{exam.class.class}})</strong>
                </v-card-text>
                <v-card-text v-else>
                Please confirm that you want to put an end to this exam: <strong>{{exam.subject.subject_name}} ({{exam.class.class}})</strong>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn :disabled="loading" color="green darken-1" text @click="examDialog = false">No</v-btn>
                    <v-btn :loading="loading" :disabled="loading" color="green darken-1" text @click="exam.hasStarted ? endExam() : startExam()">Yes</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>

        <v-dialog v-model="dialog" max-width="500" persistent>
            <v-card>
                <v-card-title v-if="!exam.hasBeenWritten" class="headline">Change Exam Parameters</v-card-title>
                <v-card-title v-else class="headline">Create New Exam</v-card-title>
                <v-container>
                    <v-row>
                        <v-col cols="12" sm="6" md="6">
                            <v-select :items="hourArray" v-model="hours" :menu-props="{ maxHeight: '400' }" label="Hours"></v-select>
                        </v-col>
                        <v-col cols="12" sm="6" md="6">
                            <v-select :items="minuteArray" v-model="minutes" :menu-props="{ maxHeight: '400' }" label="Minutes"></v-select>
                        </v-col>
                    </v-row>

                    <v-menu ref="dateMenu" v-model="dateMenu" :close-on-content-click="false" transition="scale-transition" offset-y max-width="290px" min-width="290px">
                      <template v-slot:activator="{ on }">
                          <v-text-field readonly v-model="date" label="Date" v-on="on"></v-text-field>
                      </template>
                      <v-date-picker :color="yellow" :min="today"  v-model="date" no-title @input="dateMenu = false"></v-date-picker>
                    </v-menu>

                    <v-text-field type="number" v-model="totalMarks" persistent-hint label="Aggregate Score" hint="Note: candidate scores will be calculated using this as a base value">

                    </v-text-field>
                </v-container>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn :disabled="loading" color="green darken-1" text @click="backToPrevious">CLOSE</v-btn>
                    <v-btn :loading="loading" :disabled="loading || ((hours == 0 && minutes == 0) || totalMarks < 5)" color="green darken-1" text @click="exam.hasBeenWritten ? setExam('create') : setExam('update')">SAVE</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </div>
</template>

<script>
export default {
    name: "ExamParams",
    props: ['exam','yellow','examCount','questionCount','subject','classId'],
    data() {
        return {
            hours: this.exam.hasBeenWritten ? 0 : this.exam.hours,
            minutes: this.exam.hasBeenWritten ? 0 : this.exam.minutes,
            totalMarks: this.exam.hasBeenWritten ? 50 : this.exam.base_score,
            date: this.exam.hasBeenWritten ? new Date().toISOString().substr(0, 10) : this.exam.date,
            today: new Date().toISOString().substr(0, 10),
            hourArray: [0,1,2,3,4,5,6],
            minuteArray: [0,5,10,15,20,25,30,35,40,45,50,55],
            dialog: false,
            examDialog: false,
            loading: false,
            dateMenu: false,
            snackbar: false,
            snackbarText: ''
        }
    },
    methods: {
        setExam(type) {
            this.loading = true
            let { hours, minutes, totalMarks, date } = this;

            if (type == 'create') {
                this.$http.post('exams', {
                hours,
                minutes,
                date,
                base_score: totalMarks,
                class_id: this.classId,
                subject_id: this.subject
                })
                .then(res => {
                    this.loading = false
                    this.dialog = false
                    this.$emit('setExam', 'create', res.data.exam)
                    this.snackbar = true
                    this.snackbarText = res.data.message
                })
                .catch(err => {
                    this.loading = false
                    this.dialog = false
                    console.log(err.response.data)
                    alert("There was an error creating this examination, please try again")
                })
            }

            else {
                if (this.hours == this.exam.hours && this.minutes == this.exam.minutes && this.totalMarks == this.exam.base_score && this.date == this.exam.date) {
                this.loading = false;
                this.dialog = false
                }
                else {
                    this.$http.put(`exams/${this.exam.id}`, {
                        hours,
                        minutes,
                        date,
                        base_score: totalMarks
                    })
                    .then(res => {
                        this.loading = false
                        this.dialog = false
                        this.$emit('setExam', 'update', res.data.exam)
                        this.snackbar = true
                        this.snackbarText = res.data.message

                    })
                    .catch(err => {
                        this.loading = false
                        this.dialog = false
                        console.log(err.response.data)
                        alert("There was an error updating this exam, please try again")
                    })
                }
            }
        },
        backToPrevious() {
            this.hours = this.exam.hours
            this.minutes = this.exam.minutes
            this.totalMarks = this.exam.base_score
            this.dialog = false
        },
        startExam() {
            this.loading = true

            this.$http.patch('start-exam', {
                class_id: this.classId,
                subject_id: this.subject
            })
            .then(res => {
                this.loading = false
                this.examDialog = false
                this.$emit('setExam', 'update', res.data.exam)
            })
            .catch(err => {
                this.loading = false
                this.examDialog = false
                console.error(err.response.data)
                alert("There was an error starting this exam, please try again")
            })
        },
        endExam() {
            this.loading = true

            this.$http.patch(`end-exam/${this.exam.id}`, {
                class_id: this.classId,
                subject_id: this.subject
            })
            .then(res => {
                this.loading = false
                this.examDialog = false
                this.$emit('setExam', 'update', res.data.exam)
            })
            .catch(err => {
                this.loading = false
                this.examDialog = false
                console.error(err.response.data)
                alert("There was an error ending this exam, please try again")
            })
        }
    },
    computed: {
        examtime() {
            let time;
            if (this.exam.hours > 0) {
                if (this.exam.hours == 1) {
                    this.exam.minutes == 0 ? time = "1 hour" : time = `1 hour and ${this.exam.minutes} minutes`
                }
                else {
                    this.exam.minutes == 0 ? time = `${this.exam.hours} hours` : time = `${this.exam.hours} hours and ${this.exam.minutes} minutes`
                }
            }

            else {
                time = `${this.exam.minutes} minutes`
            }

            return time
        },
        refinedDate() {
            const options = { year: "numeric", month: "long", day: "numeric" }
            return new Date(this.exam.date).toLocaleDateString(undefined, options)
        },
    }
}
</script>

<style scoped>

</style>
