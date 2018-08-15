<template>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Nieuw event</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Blank Page</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Title</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                            <i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="inputEventName" class="col-sm-2 control-label">Event naam</label>
                        <div class="col-sm-10">
                            <input v-model="event.model" type="text" class="form-control" id="inputEventName" placeholder="Event naam" autocomplete="off" data-lpignore="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEventLocation" class="col-sm-2 control-label">Locatie</label>
                        <div class="col-sm-10">
                            <input v-model="event.location" type="text" class="form-control" id="inputEventLocation" placeholder="Locatie" autocomplete="off" data-lpignore="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Startdatum en tijd</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                            </div>
                            <date-time v-model="event.start"></date-time>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Einddatum en tijd</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                            </div>
                            <date-time v-model="event.end"></date-time>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button @click="createEvent()" type="submit" class="btn btn-info">Opslaan</button>
                    <button type="submit" class="btn btn-default float-right">Cancel</button>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
    import DateTime from '../DateTime';
    export default {
        name: "New",
        data () {
            return {
                event: {
                    name: '',
                    location: '',
                    start: Date.now(),
                    end: Date.now(),
                }
            }
        },
        methods: {
            createEvent() {
                this.axios.post('/event/new', this.event);
            }
        },
        components: {
            DateTime
        }
    }
</script>

<style scoped>

</style>
