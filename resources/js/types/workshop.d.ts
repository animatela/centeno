declare namespace Workshop {
    export interface Customer {
        id: number
        name?: string
        email?: string
        phone?: string
        gender?: string
        birthday?: string
        photo?: string
        document_type?: string
        document_number?: string
        created_at?: string
        updated_at?: string
        deleted_at?: string

        user_id?: number
    }
}
