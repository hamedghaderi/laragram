<template>
    <ais-instant-search :search-client="searchClient" index-name="users" class="w-full">
        <ais-search-box placeholder="Search contacts...">
            <div slot-scope="{ currentRefinement, isSearchStalled, refine }" class="w-full">
                <input
                        class="bg-gray-200 px-4 py-2 rounded text-gray-700 border focus:outline-none focus:border-indigo-500 w-full pl-12"
                        type="search"
                        placeholder="Are you looking for someone...?"
                        v-model="currentRefinement"
                        @keyup="showResults"
                        @input="refine($event.currentTarget.value)"
                >
<!--                <span :hidden="!isSearchStalled">Loading...</span>-->
            </div>
        </ais-search-box>

        <ais-hits v-if="show" class="absolute bg-white rounded shadow-lg p-4 w-full">
            <template
                    slot="item"
                    slot-scope="{ item }"
            >
                <a :href="item.path" class="text-gray-500 block py-2 hover:bg-indigo-100 px-2 rounded mb-1">
                    <ais-highlight
                            :hit="item"
                            attribute="name"
                    />
                </a>
            </template>
        </ais-hits>

    </ais-instant-search>
</template>

<script>
    import algoliasearch from 'algoliasearch/lite';

    export default {
        props: ['token', 'identification'],

        data() {
            return {
                searchClient: algoliasearch(
                    this.identification,
                    this.token
                ),

                show: false
            };
        },

        methods: {
            showResults(event) {
              if (event.target.value === '') {
                 this.show = false;
                 return;
              }

              this.show = true;
            }
        }
    };
</script>

<style>
    mark {
        background-color: transparent;
        color: #667eea;
    }
</style>
