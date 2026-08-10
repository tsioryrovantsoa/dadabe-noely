<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import type { PaginationLink } from '@/types';

defineProps<{ links: PaginationLink[] }>();

function label(link: PaginationLink): string {
    if (link.label.includes('Previous')) {
        return 'Précédent';
    }

    if (link.label.includes('Next')) {
        return 'Suivant';
    }

    return link.label;
}
</script>

<template>
    <nav v-if="links.length > 3" class="flex flex-wrap justify-center gap-2">
        <template v-for="link in links" :key="link.label">
            <Link
                v-if="link.url"
                :href="link.url"
                class="rounded-full px-4 py-2 text-sm"
                :class="
                    link.active
                        ? 'bg-pine font-semibold text-cream'
                        : 'bg-white text-bark hover:bg-cream-dark'
                "
            >
                {{ label(link) }}
            </Link>
            <span
                v-else
                class="rounded-full px-4 py-2 text-sm text-bark-soft/50"
            >
                {{ label(link) }}
            </span>
        </template>
    </nav>
</template>
