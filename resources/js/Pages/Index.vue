<template>
    <div>
        <template >
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                index
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    123 {{ data}} 1
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import AppLayout from './../Layouts/AppLayout'
    import Welcome from './../Jetstream/Welcome'

    export default {
        props: [
            'data',
        ],
        components: {
            AppLayout,
        },
    }
</script>
