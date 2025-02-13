-- add new columns
ALTER TABLE transaction_verification
ADD new_column1 VARCHAR(255) NULL DEFAULT NULL,
ADD new_column2 VARCHAR(255) NULL DEFAULT NULL;


-- table operational_details
ALTER TABLE operational_details MODIFY abe_name VARCHAR(100) NULL DEFAULT NULL;
ALTER TABLE operational_details MODIFY abm_name VARCHAR(100) NULL DEFAULT NULL;
ALTER TABLE operational_details MODIFY rm_name VARCHAR(100) NULL DEFAULT NULL;
ALTER TABLE operational_details MODIFY zm_name VARCHAR(100) NULL DEFAULT NULL;
ALTER TABLE operational_details MODIFY operating_hours VARCHAR(250) NULL DEFAULT NULL;
ALTER TABLE operational_details MODIFY designated_location VARCHAR(10) NULL DEFAULT NULL;
ALTER TABLE operational_details MODIFY designated_location_remarks VARCHAR(250) NULL DEFAULT NULL;
ALTER TABLE operational_details MODIFY training_given VARCHAR(10) NULL DEFAULT NULL;
ALTER TABLE operational_details MODIFY training_remarks VARCHAR(250) NULL DEFAULT NULL;
ALTER TABLE operational_details MODIFY business_explore VARCHAR(10) NULL DEFAULT NULL;
ALTER TABLE operational_details MODIFY business_explore_remarks VARCHAR(250) NULL DEFAULT NULL;
ALTER TABLE operational_details MODIFY target_set VARCHAR(10) NULL DEFAULT NULL;
ALTER TABLE operational_details MODIFY target_clear VARCHAR(10) NULL DEFAULT NULL;
ALTER TABLE operational_details MODIFY target_documented VARCHAR(10) NULL DEFAULT NULL;
ALTER TABLE operational_details MODIFY abe_support VARCHAR(10) NULL DEFAULT NULL;
ALTER TABLE operational_details MODIFY bank_support VARCHAR(10) NULL DEFAULT NULL;
ALTER TABLE operational_details MODIFY target_remarks VARCHAR(250) NULL DEFAULT NULL;
ALTER TABLE operational_details MODIFY onboarding_fee_paid VARCHAR(10) NULL DEFAULT NULL;
ALTER TABLE operational_details MODIFY fee_unclear VARCHAR(10) NULL DEFAULT NULL;
ALTER TABLE operational_details MODIFY fees_documented VARCHAR(10) NULL DEFAULT NULL;
ALTER TABLE operational_details MODIFY fee_payment_mode VARCHAR(20) NULL DEFAULT NULL;
ALTER TABLE operational_details MODIFY onboarding_remarks VARCHAR(250) NULL DEFAULT NULL;
ALTER TABLE operational_details MODIFY rm_visit VARCHAR(10) NULL DEFAULT NULL;
ALTER TABLE operational_details MODIFY rm_visit_remarks VARCHAR(250) NULL DEFAULT NULL;
ALTER TABLE operational_details MODIFY abm_visit VARCHAR(10) NULL DEFAULT NULL;
ALTER TABLE operational_details MODIFY abm_visit_remarks VARCHAR(250) NULL DEFAULT NULL;
ALTER TABLE operational_details MODIFY abe_visit VARCHAR(10) NULL DEFAULT NULL;
ALTER TABLE operational_details MODIFY abe_visit_remarks VARCHAR(250) NULL DEFAULT NULL;
ALTER TABLE operational_details MODIFY bank_official_visit VARCHAR(10) NULL DEFAULT NULL;
ALTER TABLE operational_details MODIFY bank_official_visit_remarks VARCHAR(250) NULL DEFAULT NULL;
ALTER TABLE operational_details MODIFY bc_visit VARCHAR(10) NULL DEFAULT NULL;
ALTER TABLE operational_details MODIFY bc_visit_remarks VARCHAR(250) NULL DEFAULT NULL;
ALTER TABLE operational_details MODIFY last_updated_by_id VARCHAR(20) NULL DEFAULT NULL;
ALTER TABLE operational_details MODIFY last_updated_date DATETIME NULL DEFAULT NULL;






-- table register_maintain

ALTER TABLE register_maintain MODIFY audit_number VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE register_maintain MODIFY transaction_register VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE register_maintain MODIFY transaction_register_remarks VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE register_maintain MODIFY account_opening_register VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE register_maintain MODIFY account_opening_register_remarks VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE register_maintain MODIFY complaint_register VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE register_maintain MODIFY complaint_register_remarks VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE register_maintain MODIFY visitor_register VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE register_maintain MODIFY visitor_register_remarks VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE register_maintain MODIFY cash_register VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE register_maintain MODIFY cash_register_remarks VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE register_maintain MODIFY audit_register VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE register_maintain MODIFY audit_register_remarks VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE register_maintain MODIFY service_register VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE register_maintain MODIFY service_register_remarks VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE register_maintain MODIFY inventory_register VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE register_maintain MODIFY inventory_register_remarks VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE register_maintain MODIFY loan_register VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE register_maintain MODIFY loan_register_remarks VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE register_maintain MODIFY customer_feedback_register VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE register_maintain MODIFY customer_feedback_register_remarks VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE register_maintain MODIFY compliance_register VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE register_maintain MODIFY compliance_register_remarks VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE register_maintain MODIFY staff_attendance_register VARCHAR(255) NULL DEFAULT NULL;


-- table compliance_verification

ALTER TABLE compliance_verification MODIFY audit_number VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE compliance_verification MODIFY bc_point_place VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE compliance_verification MODIFY bc_point_place_remarks VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE compliance_verification MODIFY bc_point_clean VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE compliance_verification MODIFY bc_point_clean_remarks VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE compliance_verification MODIFY posters_displayed VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE compliance_verification MODIFY outdated_posters VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE compliance_verification MODIFY posters_remarks VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE compliance_verification MODIFY customer_alert_dos_donts VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE compliance_verification MODIFY customer_alert_dos_donts_remarks VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE compliance_verification MODIFY verification_certificate VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE compliance_verification MODIFY verification_certificate_remarks VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE compliance_verification MODIFY unauthorized_individuals VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE compliance_verification MODIFY unauthorized_individuals_remarks VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE compliance_verification MODIFY id_card_usage VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE compliance_verification MODIFY id_card_usage_remarks VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE compliance_verification MODIFY clone_fingerprint VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE compliance_verification MODIFY clone_fingerprint_remarks VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE compliance_verification MODIFY manual_receipts VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE compliance_verification MODIFY system_generated_receipts VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE compliance_verification MODIFY customer_passbooks VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE compliance_verification MODIFY transaction_slips VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE compliance_verification MODIFY manual_receipts_remarks VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE compliance_verification MODIFY non_relevant_applications VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE compliance_verification MODIFY blocked_accounts VARCHAR(255) NULL DEFAULT NULL;


-- table transaction_verification

ALTER TABLE transaction_verification MODIFY audit_number VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE transaction_verification MODIFY proc_trans VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE transaction_verification MODIFY remarks_proc_trans VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE transaction_verification MODIFY proc_dep_with VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE transaction_verification MODIFY remarks_proc_dep_with VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE transaction_verification MODIFY delay_trans VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE transaction_verification MODIFY remarks_delay_trans VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE transaction_verification MODIFY acc_trans VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE transaction_verification MODIFY remarks_acc_trans VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE transaction_verification MODIFY time_match VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE transaction_verification MODIFY remarks_time_match VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE transaction_verification MODIFY cust_ver VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE transaction_verification MODIFY remarks_cust_ver VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE transaction_verification MODIFY bc_verify VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE transaction_verification MODIFY remarks_bc_verify VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE transaction_verification MODIFY sys_receipts VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE transaction_verification MODIFY remarks_sys_receipts VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE transaction_verification MODIFY cust_copy VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE transaction_verification MODIFY remarks_cust_copy VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE transaction_verification MODIFY presc_limits VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE transaction_verification MODIFY remarks_presc_limits VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE transaction_verification MODIFY auth_trans VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE transaction_verification MODIFY remarks_auth_trans VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE transaction_verification MODIFY cash_handling VARCHAR(255) NULL DEFAULT NULL;

