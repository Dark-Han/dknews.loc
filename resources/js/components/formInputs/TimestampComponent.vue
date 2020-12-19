<template>
    <div>
        <v-row>
            <v-col>
                <v-menu
                    v-model="dateMenu"
                    :close-on-content-click="false"
                    :nudge-right="40"
                    transition="scale-transition"
                    offset-y
                    min-width="290px"
                >
                    <template v-slot:activator="{ on, attrs }">
                        <v-text-field
                            v-model="formattedDate"
                            label="Дата начала"
                            prepend-icon="mdi-calendar"
                            readonly
                            v-bind="attrs"
                            v-on="on"
                        ></v-text-field>
                    </template>
                    <v-date-picker
                        v-model="timestamp.date"
                        locale="ru"
                        @input="dateMenu = false"
                    ></v-date-picker>
                </v-menu>
            </v-col>
            <v-col>
                <v-menu
                    ref="timeMenu"
                    v-model="timeMenu"
                    :close-on-content-click="false"
                    :nudge-right="40"
                    transition="scale-transition"
                    offset-y
                    max-width="290px"
                    min-width="290px"
                >
                    <template v-slot:activator="{ on, attrs }">
                        <v-text-field
                            v-model="timestamp.time"
                            label="Время"
                            prepend-icon="mdi-clock-time-four-outline"
                            readonly
                            v-bind="attrs"
                            v-on="on"
                        ></v-text-field>
                    </template>
                    <v-time-picker
                        v-if="timeMenu"
                        format="24hr"
                        v-model="timestamp.time"
                        full-width
                        @click:minute="$refs.timeMenu.save(timestamp.time)"
                    ></v-time-picker>
                </v-menu>
            </v-col>
        </v-row>
    </div>
</template>

<script>
    export default {
        props:['currentDate','editedIndex'],
        data:()=>({
            timeMenu:false,
            dateMenu:false,
            formattedDate:null,
            timestamp:{
                date:null,
                time:null
            }
        }),
        created(){
            this.setDefaultDate();
            this.setDefaultTime();
        },
        watch:{
            'timestamp.date':function (val) {
                this.formattedDate=this.formatDate(val);
                this.setTimestamp();
            },
            'timestamp.time':function (val) {
                this.setTimestamp();
            },
            editedIndex(val){
                if(val>-1){
                    this.setCurrentDate();
                    this.setCurrentTime();
                }else{
                    this.setDefaultDate();
                    this.setDefaultTime();
                }
            }
        },
        methods:{
            setTimestamp(){
                this.$emit('onSetTimestamp',this.timestamp);
            },
            formatDate(date){
                if (!date) return null
                const [year, month, day] = date.split('-')
                return `${day}.${month}.${year}`;
            },
            setDefaultDate(){
                this.formattedDate=this.formatDate(new Date().toISOString().substr(0, 10));
                this.timestamp.date=new Date().toISOString().substr(0, 10);
            },
            setDefaultTime(){
                var date=new Date();
                this.timestamp.time=date.getHours()+':'+(date.getMinutes()<10?'0':'') + date.getMinutes();
            },
            setCurrentDate(){
                let date=new Date(this.currentDate.date);
                this.formattedDate=this.formatDate(date.toISOString().substr(0, 10));
                this.timestamp.date=date.toISOString().substr(0, 10);
            },
            setCurrentTime(){
                var date=new Date(this.currentDate.date);
                this.timestamp.time=date.getHours()+':'+(date.getMinutes()<10?'0':'') + date.getMinutes();
            }
        }
    }
</script>
