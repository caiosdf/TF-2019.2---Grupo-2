import { CUSTOM_ELEMENTS_SCHEMA } from '@angular/core';
import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { AlteraEmailPage } from './altera-email.page';

describe('AlteraEmailPage', () => {
  let component: AlteraEmailPage;
  let fixture: ComponentFixture<AlteraEmailPage>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ AlteraEmailPage ],
      schemas: [CUSTOM_ELEMENTS_SCHEMA],
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(AlteraEmailPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
